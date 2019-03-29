<template>
  <v-content>
    <v-container class="text-xs-center">
      <h3>Thank You for Your Registration</h3>
      <p>Please Download Our App</p>
      <v-img
        src="/images/googleplay.png"
        @click="googlePlay"
        lazy-src="/images/googleplay.png"
        aspect-ratio="3.10"
      ></v-img>
      <v-spacer></v-spacer>
      <v-img src="/images/applestore.png" lazy-src="/images/applestore.png" aspect-ratio="3.9"></v-img>
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
