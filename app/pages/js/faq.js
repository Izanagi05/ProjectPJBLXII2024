import NavbarLanding from "~/components/NavbarLanding.vue";
import Footer from "~/components/Footer.vue";
export default{
  layout: "default",
  components: {
    NavbarLanding,
    Footer
  },
  data() {
    return {
      cardData: [
        {
          icon: 'mdi-account',
          col:'6',
          iconColor: '#0E6AE3',
          title: 'Getting started 1',
          description: 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repellat, dolores?',
        },
        {
          icon: 'mdi-account',
          col:'6',
          iconColor: '#0E6AE3',
          title: 'Getting started 2',
          description: 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repellat, dolores?',
        },
        {
          icon: 'mdi-account',
          col:'6',
          iconColor: '#0E6AE3',
          title: 'Getting started 3',
          description: 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repellat, dolores?',
        },
        {
          icon: 'mdi-account',
          col:'6',
          iconColor: '#0E6AE3',
          title: 'Getting started 4',
          description: 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repellat, dolores?',
        },
        {
          icon: 'mdi-account',
          col:'12',
          iconColor: '#0E6AE3',
          title: 'Getting started 4',
          description: 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repellat, dolores?',
        },
      ],
      expansionPanelData: [
        {
          header: 'Item 1',
          content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
        },
        {
          header: 'Item 2',
          content: 'Content for Item 2...',
        },
        {
          header: 'Item 3',
          content: 'Content for Item 3...',
        },
        {
          header: 'Item 4',
          content: 'Content for Item 4...',
        },
        {
          header: 'Item 5',
          content: 'Content for Item 5...',
        },
        {
          header: 'Item 6',
          content: 'Content for Item 6...',
        },
      ],
      datacontact:[
        {
          image:'uun.jpeg',
          name:'Uun Sakinah Aeni',
          mail:'izanagifarisaslam5@Gmail.com'
        },
        {
          image:'akmal.jpeg',
          name:'Akmal Abrisal Rizki',
          mail:'izanagifarisaslam5@Gmail.com'
        },
        {
          image:'iza.jpeg',
          name:'Izanagi Faris Aslam',
          mail:'izanagifarisaslam5@Gmail.com'
        }
      ]
    }
  },
}
