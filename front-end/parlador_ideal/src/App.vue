<template>
  <main>
   <BaseContainer class="justify-center">
    <SplashScreen v-if="showSplashScreen"/>
    <router-view></router-view>
  </BaseContainer>
  </main>
</template>

<script>
import SplashScreen from './components/SplashScreen.vue';
import BaseContainer from './components/BaseContainer.vue';
export default {
  name: 'App',
  components: {
    BaseContainer,
    SplashScreen,
  },
  data() {
    return {
      showSplashScreen: true,
      userAuthenticated: false
    }
  },
  mounted() {
    if (this.$route.path == "/") {
      setTimeout(() => {    
        this.showSplashScreen = false;
      }, 2000);
    }
    this.showSplashScreen = false;
    this.loadFirstScreen()
  },
  methods: {
    loadFirstScreen: function() {
      if (this.userAuthenticated) {
          this.$router.replace('/register')
      }
      else {
        this.$router.replace('/login')
      }
    }
  }
}
</script>