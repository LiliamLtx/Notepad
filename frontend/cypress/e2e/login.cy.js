describe('Login', () => {
    //Arrange
    beforeEach(() => {
        cy.visit('/login')
    })

    it('Realizar login com sucesso', () => {
        //Act
        cy.get('[data-test="username"]').type('Testandoo@gmail.com')
        cy.get('[data-test="password"]').type('123456')
        cy.get('[data-test="login"]').click()
        //Assert
        cy.url().should('include', '/home')
        cy.get('[data-test="TopBar"]')
            .should('be.visible')
            .and('exist')
    })

    it('Realizar login com credenciais erradas', () => {

        //Act
        cy.get('[data-test="username"]').type('errando@gmail.com')
        cy.get('[data-test="password"]').type('errada')
        cy.get('[data-test="login"]').click()
        //Assert
        cy.get('[data-test="error"]')
            .should('contain.text', 'Credenciais inválidas')


    })
})