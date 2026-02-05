describe('Notes Management', () => {
  //Arrange

  beforeEach(() => {
    // Intercepta o carregamento inicial das notas (GET)
    cy.intercept('GET', '**/api/notes').as('getNotes')

    cy.request('POST', 'http://127.0.0.1:8000/api/login', {
      text_username: 'Testandoo@gmail.com',
      text_password: '123456'
    }).then((response) => {
      const token = response.body.token
      cy.visit('/home', {
        onBeforeLoad(win) {
          win.localStorage.setItem('token', token)
        }
      })
    })

    // Aguarda as notas carregarem antes de qualquer teste
    cy.wait('@getNotes')
  })

  it('Deve criar a primeira nota com sucesso', () => {
    cy.intercept('POST', '**/api/notes').as('postNote')
    //Act
    cy.get('[data-test="button-newfirst"]').click()
    cy.get('[data-test="noteTitle"]').type('Nota Inicial')
    cy.get('[data-test="noteText"]').type('Conteúdo da nota')
    cy.get('[data-test="button-save"]').click()
    //Assert
    cy.wait('@postNote').its('response.statusCode').should('be.oneOf', [200, 201])
    cy.get('.text-info').should('contain.text', 'Nota Inicial')
  })

  it('Deve editar uma nota com sucesso (Update)', () => {
    cy.intercept('PUT', '**/api/notes/*').as('putNote')
    cy.intercept('GET', '**/api/notes/*').as('getNoteDetail')

    //Act
    cy.contains('.text-info', 'Nota Inicial')
      .closest('[data-test="note-card"]')
      .find('[data-test="button-edit"]')
      .click()
    //Arrange
    cy.wait('@getNoteDetail')
    cy.get('[data-test="noteTitle"]').clear().type('Título Atualizado')
    cy.get('[data-test="button-update"]').click()

    // Aguarda a API confirmar a atualização
    cy.wait('@putNote').its('response.statusCode').should('eq', 200)
    cy.get('.text-info').should('contain.text', 'Título Atualizado')
  })

  it('Deve excluir uma nota com sucesso (Delete)', () => {
    cy.intercept('DELETE', '**/api/notes/*').as('deleteNote')
    //Act
    cy.contains('.text-info', 'Título Atualizado')
      .closest('[data-test="note-card"]')
      .find('[data-test="button-delete"]') 
      .click()
    cy.get('[data-test="delete-card"]').should('be.visible')
    cy.get('[data-test="confirm-button"]').click()

    //Assert
    cy.wait('@deleteNote').its('response.statusCode').should('be.oneOf', [200, 204])
    cy.contains('Título Atualizado').should('not.exist')
  })

  it('Deve exibir erro ao tentar salvar nota vazia', () => {
    //Act
    cy.get('[data-test="button-newfirst"]').should('be.visible').click()
    cy.url().should('include', '/new')
    cy.get('[data-test="newNote-form"]')
      .should('exist')
      .and('be.visible')
    cy.get('[data-test="button-save"]').click()
    //Assert
    cy.get('[data-test="title-danger"]').should('be.visible')
    cy.get('[data-test="text-danger"]').should('be.visible')
  })
})
