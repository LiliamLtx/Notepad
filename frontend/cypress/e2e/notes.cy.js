describe('Notes', () => {
  beforeEach(() => {
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
  })

  it('Realizar criação de notas com sucesso', () => {
    cy.get('[data-test="button-new"]').should('be.visible').click()
    cy.url().should('include', '/new')
    cy.get('[data-test="newNote-form"]')
      .should('exist')
      .and('be.visible')
    cy.get('[data-test="noteTitle"]').type('Titulo da Nota')
    cy.get('[data-test="noteText"]').type('Texto da nota')
    cy.get('[data-test="button-save"]').click()
    cy.get('.text-info').should('contain.text', 'Titulo da Nota')
  })
})
