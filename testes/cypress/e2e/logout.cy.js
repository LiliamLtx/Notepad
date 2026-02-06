describe('Logout', () => {
    

    it('Logout com sucesso', () => {
        //Arrange
        cy.visit('/login')
        //Act
        cy.get('[data-test="username"]').type('Testandoo@gmail.com')
        cy.get('[data-test="password"]').type('123456')
        cy.get('[data-test="login"]').click()
        //Assert
        cy.get('[data-test="botton-logout"]').should('be.visible').and('exist')
        cy.get('[data-test="botton-logout"]').click()
        cy.url().should('include', '/login')
    })
})

