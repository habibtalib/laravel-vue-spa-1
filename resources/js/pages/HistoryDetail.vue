<template>
  <v-content>
    <v-container>
      <v-card>
        <v-card-title primary-title>
          <div>
            <h4 class="headline mb-0">Order Details #{{ orders.id }}</h4>
          </div>
        </v-card-title>
        <table class="table is-striped">
          <tbody>
            <tr>
              <td>Order Date</td>
              <td>{{ orders.created_at }}</td>
            </tr>
            <tr>
              <td>Order Status</td>
              <td>{{ orders.status | filterStatus }}</td>
            </tr>
            <tr>
              <td>Total</td>
              <td>RM{{ orders.total || '2,000' }}</td>
            </tr>
          </tbody>
        </table>
      </v-card>
      <v-card>
        <v-card-title primary-title>
          <div>
            <h4 class="headline mb-0">Order Items</h4>
          </div>
        </v-card-title>
        <table class="table is-striped">
          <thead>
            <tr>
              <td>Item</td>
              <td>Quantity</td>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(p, index) in ordersItems" :key="index">
              <td>{{ filterProduct(p.product_id).name}}</td>
              <td>{{ p.quantity }}</td>
            </tr>
          </tbody>
        </table>
      </v-card>
      <v-card>
        <v-card-title primary-title>
          <div>
            <h4 class="headline mb-0">Payment</h4>
          </div>
        </v-card-title>
        <v-card-text class="text-xs-center">
          <upload-btn>
            <template slot="icon">
              <v-icon>add</v-icon>
            </template>
          </upload-btn>
          <v-input type="file"></v-input>
          <v-btn class="mx-0 font-weight-light" color="success">Update Order</v-btn>
        </v-card-text>
      </v-card>
    </v-container>
  </v-content>
</template>
<script>
import UploadButton from "vuetify-upload-button";
import { mapGetters } from "vuex";
export default {
  components: {
    "upload-btn": UploadButton
  },
  data() {
    return {
      email: "",
      name: "",
      phone: "",
      city: "",
      state: "",
      province: "",
      downline: [],
      downline_id: "",
      orders: [],
      ordersItems: []
    };
  },
  methods: {
    filterProduct: function(id) {
      return this.products.find(product => product.id === id);
    }
  },
  filters: {
    filterStatus: function(value) {
      if (value === 1) {
        return "Pending Payment";
      }
      if (value === 2) {
        return "Paid";
      }
      if (value === 3) {
        return "Shipped";
      }
    }
  },
  created() {
    this.$store.dispatch("loadProducts");
    // this.$store.dispatch("loadMerhandise");
    let self = this;
    axios
      .get("/orders/" + this.$route.params.id)
      .then(function(response) {
        // handle success
        self.orders = response.data.data.order;
        self.ordersItems = response.data.data.order_items;
        console.log(response);
      })
      .catch(function(error) {
        // handle error
        console.log(error);
      })
      .then(function() {
        // always executed
      });
  },
  computed: {
    ...mapGetters({
      products: "allProducts"
    })
  }
};
</script>
