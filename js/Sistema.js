class Sistema {
    constructor() {
        this.easing = 'cubic-bezier(0, 0, 0.32, 1)';
        this.animDuration = 3e2;
        this.sidebarLinkActiveClass = 'bg-info';


        this.navegar = this.navegar.bind(this);
        this.ajaxLoad = this.ajaxLoad.bind(this);
        this.busquedaEnviar = this.busquedaEnviar.bind(this);

        this.doDebug = this.doDebug.bind(this);

        this.addListeners = this.addListeners.bind(this);
    }

    addListeners() {
        let conClickListeners = document.querySelectorAll('.listening-click');
        Array.from(conClickListeners).forEach(i=> {
            i.removeEventListener('click')
        })
    }

    tabSwap(tabIn, clickEn) {
        console.info('navegando a ' + tabIn);
        let esconder = document.querySelector('.tab-activo');
        let mostrar = document.querySelector(tabIn);

        if (mostrar.classList.contains('tab-activo') ||
            mostrar.classList.contains('no-click')) {
            return
        }

        let links = document.querySelectorAll('.sidebar-link');
        Array.from(links).forEach(i => {
            i.classList.remove(this.sidebarLinkActiveClass);
        });
        clickEn.classList.add(this.sidebarLinkActiveClass);
        clickEn.classList.add('no-click');


        let opciones = {
            // opciones
            duration: this.animDuration,
            iterations: 1,
            easing: this.easing,
            fill: 'forwards'
        };

        let outAnim = esconder.animate([
            // keyframes
            {transform: 'translate(0, 0)', opacity: '1'},
            {transform: 'translate(-100px, 0)', opacity: '0'}
        ], opciones);

        outAnim.addEventListener('finish', e => {
            esconder.classList.remove('tab-activo');
            mostrar.classList.add('tab-activo');
            let inAnim = mostrar.animate([
                // keyframes
                {transform: 'translate(100px, 0)', opacity: '0'},
                {transform: 'translate(0, 0)', opacity: '1'}
            ], opciones);
            clickEn.classList.remove('no-click');
        })

    };

    navegar(e) {
        // console.log(e.target);
    }

    ajaxLoad(url) {
        fetch(url)
            .then(r => r.text())
            .then(r => document.getElementById('ajaxLoad').innerHTML = r);
    }

    doDebug() {
        this.tabSwap('#contratos');
    }

    busquedaEnviar(event) {
        console.log(event.getElementsByTagName("input"));
        debugger;
        console.log(event);
        event.preventDefault();

    }
}

let sistema = new Sistema();