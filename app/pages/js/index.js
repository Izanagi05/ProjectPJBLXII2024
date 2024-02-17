import NavbarLanding from "~/components/NavbarLanding.vue";
import Footer from "~/components/Footer.vue";
export default {
  layout: "default",
  components: {
    NavbarLanding,
    Footer
  },
  data() {
    return {
      dataItems: [
        {
          icon: 'mdi-account',
          iconColor: '#0E6AE3',
          title: 'Lorem ipsum dolor sit amet consectetur.',
          description: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt, minus autem! Sed impedit repellendus in ratione.',
        },
        {
          icon: 'mdi-account',
          iconColor: '#0E6AE3',
          title: 'Lorem ipsum dolor sit amet consectetur.',
          description: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt, minus autem! Sed impedit repellendus in ratione.',
        },
        {
          icon: 'mdi-account',
          iconColor: '#0E6AE3',
          title: 'Lorem ipsum dolor sit amet consectetur.',
          description: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt, minus autem! Sed impedit repellendus in ratione.',
        },
      ],
    }
  },
};
