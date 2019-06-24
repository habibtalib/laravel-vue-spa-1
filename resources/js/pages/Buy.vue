<template>
  <v-content>
    <v-card>
      <v-container fluid grid-list-lg>
        <v-layout row wrap>
          <v-flex xs12 v-for="product in products" :key="product.id">
            <v-card color="#bf1f31" class="white--text">
              <v-layout row>
                <v-flex xs7>
                  <v-card-title primary-title>
                    <div>
                      <div class="headline">{{product.name}}</div>
                      <div>RM{{product.price}}</div>
                    </div>
                  </v-card-title>
                </v-flex>
                <v-flex xs5>
                  <v-img
                    :src="'https://sys.meeracle.com.my/storage/'+product.image"
                    height="125px"
                    contain
                  ></v-img>
                </v-flex>
              </v-layout>
              <v-divider light></v-divider>
              <v-card-actions class="pa-3">
                <v-flex xs4 sm4 md3>
                  <v-text-field
                    label="Quantity"
                    value="1"
                    v-model="product.quantity"
                    background-color="white"
                    color="white"
                    type="number"
                    outline
                  ></v-text-field>
                </v-flex>
                <v-flex xs1 sm1 md1>
                  <v-btn @click="addToCart(product)">Add to Cart</v-btn>
                </v-flex>
              </v-card-actions>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
    </v-card>
  </v-content>
</template>
<script>
import axios from "axios";
import { mapGetters, mapActions } from "vuex";
export default {
  computed: {
    ...mapGetters({
      products: "allProducts",
      length: "getNumberOfProducts"
    })
  },
  created() {
    this.$store.dispatch("loadProducts");
  },
  data() {
    return {
      valid: true,
      url: "",
      serial: "",
      product: "",
      quantity: 1,
      store: 0,
      items: [
        { id: "1", name: "Meeracle Gemstone Serum" },
        { id: "2", name: "Meeracle Gemstone Cleanser" }
      ]
    };
  },
  methods: {
    ...mapActions(["addToCart"])
  }
};
</script>
