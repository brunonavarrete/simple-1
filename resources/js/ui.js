/**
 * 
 * UI / UX
 * 
 */

    /* sync scrolls */

        var mainContent = document.getElementById('main-content')
        var headerEmployees = document.getElementById('header-employees')

        mainContent.addEventListener('scroll', () => {
            let scroll = mainContent.scrollLeft
            headerEmployees.scrollLeft = scroll
        })

        headerEmployees.addEventListener('scroll', () => {
            let scroll = headerEmployees.scrollLeft
            mainContent.scrollLeft = scroll
        })