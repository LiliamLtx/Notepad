describe('Login', () => {
    //Arrange
    beforeEach(() => {
        cy.visit('/register')
    })

    it('Realizar cadastro com sucesso', () => {
        //Act
        cy.get('[data-test="name"]').type('Nome de Usuario')
        cy.get('[data-test="username"]').type('Emailvalido@gmail.com')
        cy.get('[data-test="password"]').type('senhavalida123')
        cy.get('[data-test="submit-cadastro"]').click()
        //Assert
        cy.get('[data-test="alert-sucess"]')
            .should('be.visible')
            .and('exist')

    })
    it('Realizar cadastro com erro de email existente', () => {
        //Act
        cy.get('[data-test="name"]').type('Nome de Usuario')
        cy.get('[data-test="username"]').type('Emailvalido@gmail.com')
        cy.get('[data-test="password"]').type('senhavalida123')
        cy.get('[data-test="submit-cadastro"]').click()
        //Assert
        cy.get('[data-test="alert-erro"]')
        .should('be.visible')
        .and('exist')

    })

})