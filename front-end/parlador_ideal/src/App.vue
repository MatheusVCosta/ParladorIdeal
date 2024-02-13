<template>
  <main>
   <BaseContainer class="justify-center">
    <SplashScreen v-if="showSplashScreen"/>
    <router-view v-else></router-view>
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
    setTimeout(() => {    
      this.showSplashScreen = false;
    }, 2000);
    
  },
}
</script>