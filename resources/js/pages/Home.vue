<template>
  <v-content>
    <v-carousel>
      <v-carousel-item
        v-for="(item,i) in items"
        :key="i"
        :src="item.src"
        reverse-transition="fade"
        transition="fade"
        style="background-color:#bf1f31;"
      >
        <v-responsive dark>
          <v-container fill-height>
            <v-layout align-center>
              <v-flex>
                <h4 style="color:white">{{item.title}}</h4>
                <h5 style="color:white">{{item.desc}}</h5>
              </v-flex>
            </v-layout>
          </v-container>
        </v-responsive>
      </v-carousel-item>
    </v-carousel>
    <v-bottom-nav :value="true" absolute color="transparent" v-if="$auth.check()">
      <v-btn color="#bf1f31" flat to="sell">
        <span>
          <span>Sell Product</span>
        </span>
        <v-icon>store</v-icon>
      </v-btn>

      <v-btn color="#bf1f31" flat to="genelogy">
        <span>Genelogy</span>
        <v-icon>people</v-icon>
      </v-btn>

      <v-btn color="#bf1f31" flat to="history">
        <span>History</span>
        <v-icon>history</v-icon>
      </v-btn>
    </v-bottom-nav>
    <v-bottom-nav :value="true" absolute color="transparent" v-if="!$auth.check()">
      <v-btn color="#bf1f31" flat to="sell">
        <span>
          <span>Login</span>
        </span>
        <v-icon>lock_open</v-icon>
      </v-btn>

      <!-- <v-btn color="#bf1f31" flat href="/meeracle.apk">
        <span>Download</span>
        <v-icon>tablet</v-icon>
      </v-btn>-->

      <v-btn color="#bf1f31" flat to="register">
        <span>Register</span>
        <v-icon>description</v-icon>
      </v-btn>
    </v-bottom-nav>
  </v-content>
</template>
<script>
export default {
  data() {
    return {
      items: [
        {
          src: "/images/product-07.png",
          title: "MEERACLE Gemstone Cleanser",
          desc: "Cleaner than ever."
        },
        {
          src: "/images/product-08.png",
          title: "MEERACLE Gemstone Serum",
          desc: "Fast result."
        }
      ]
    };
  },
  components: {}
};
</script>
