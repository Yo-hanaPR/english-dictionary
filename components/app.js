// Usa Vue como variable global (porque lo cargaste desde un CDN en index.php)
const CounterComponent = {
    data() {
      return {
        count: 0,
        showButton:true
      };
    },
    methods: {
        scrollToTop() {
            window.scrollTo({
            top: 0,
            behavior: 'smooth', // Hace que el scroll sea suave
            });
        },
        handleScroll() {
            // Si el scroll es mayor a 300px, muestra el botón
            this.showButton = window.scrollY > 300;
        }
    },
    mounted() {
        window.addEventListener('scroll', this.handleScroll); // Escucha el scroll de la página
    },
    beforeDestroy() {
        window.removeEventListener('scroll', this.handleScroll); // Limpia el evento cuando el componente se destruye
    },
    template: `
      <div>
        <button v-if="showButton" @click="scrollToTop" type="button" class="scroll-to-top">
            <i class="fa-solid fa-arrow-up"></i> 
        </button>
      </div>
    `,
  };
  
  // Usa Vue.createApp() en lugar de createApp()
  Vue.createApp(CounterComponent).mount('#app');
  