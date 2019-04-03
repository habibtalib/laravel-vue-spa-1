<template>
  <v-content>
    <v-container class="text-xs-center">
      <h3>Thank You for Your Registration</h3>
      <p>Please Download Our App</p>
      <v-img
        position="center"
        src="/images/googleplay.png"
        @click="googlePlay"
        lazy-src="/images/googleplay.png"
        max-width="600"
      ></v-img>
      <v-spacer></v-spacer>
      <v-img src="/images/applestore.png" lazy-src="/images/applestore.png" max-width="600"></v-img>
    </v-container>
  </v-content>
</template>
<script>
export default {
  data() {
    return {};
  },
  methods: {
    googlePlay() {
      window.open("/meeracle.apk");
    }
  }
};
</script>
