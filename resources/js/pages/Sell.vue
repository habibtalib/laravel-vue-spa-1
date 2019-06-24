<template>
  <v-content>
    <v-container style="position: relative;top: 1%;" class="text-xs-center">
      <qrcode-stream @decode="onDecode()"></qrcode-stream>
      <v-form ref="form" v-model="valid" lazy-validation>
        <v-text-field v-model="serial" label="Serial Number" required></v-text-field>
        <v-select
          :items="orders"
          item-value="id"
          item-text="id"
          label="Orders"
          v-model="product"
          required
          @change="check"
        ></v-select>
        <v-btn primary large block @click="Submit({id:product, serial})">Submit</v-btn>
      </v-form>
    </v-container>
  </v-content>
</template>
<script>
import axios from "axios";
import { mapGetters, mapActions } from "vuex";
export default {
  computed: mapGetters({
    products: "allProducts",
    length: "getNumberOfProducts"
  }),
  data() {
    return {
      valid: true,
      url: "",
      serial: [],
      product: "",
      store: 0,
      items: [
        { id: "1", name: "Meeracle Gemstone Serum" },
        { id: "2", name: "Meeracle Gemstone Cleanser" }
      ]
    };
  },
  computed: {
    ...mapGetters({
      orders: "orders"
    })
  },
  created() {
    this.$store.dispatch("loadOrders");
  },
  methods: {
    ...mapActions(["addToCart"]),
    check() {
      console.log(this.product);
    },
    onDecode(decodedString) {
      let self = this;
      console.log(decodedString);
      this.serial = decodedString;
      axios
        .post("/serial/", {
          url: decodedString
        })
        .then(function(response) {
          // handle success
          if (!self.serial.filter(response.data.serial)) {
            self.serial.push(response.data.serial);
          }
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        })
        .then(function() {
          // always executed
        });
    },
    Submit({ id, name }) {
      if (this.$refs.form.validate()) {
        this.snackbar = true;
      } else {
        this.product = this.serial = "";
        axios
          .post("/serial/", {
            url: decodedString
          })
          .then(function(response) {
            // handle success
            self.serial = response.data.serial;
          })
          .catch(function(error) {
            // handle error
            console.log(error);
          })
          .then(function() {
            // always executed
          });
      }
    }
  }
};
</script>
