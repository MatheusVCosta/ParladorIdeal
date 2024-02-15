<template>
  <main>
   <BaseContainer class="justify-center">
    <SplashScreen v-if="showSplashScreen && !isUserAuthenticated"/>
    <router-view v-else></router-view>
  </BaseContainer>
  </main>
</template>

<script>
import SplashScreen from './components/SplashScreen.vue';
import BaseContainer from './components/BaseContainer.vue';
import { request } from '@/http/request'

export default {
  name: 'App',
  components: {
    BaseContainer,
    SplashScreen,
  },
  data() {
    return {
      showSplashScreen: true,
      userAuthenticated: false,
      request: request(),
    }
  },
  computed: {
    isUserAuthenticated() {
      this.request.isAuthenticated();
    }
  },
  mounted() {
    if (this.request.isAuthenticated()) {
      this.showSplashScreen = false;
      this.$router.replace({name: 'home'})
      return
    }
    setTimeout(() => {    
      this.showSplashScreen = false;
    }, 4000);
    
  },
}
</script>