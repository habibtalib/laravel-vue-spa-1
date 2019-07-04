<template>
  <v-content>
    <v-container>
      <v-card>
        <v-card-title primary-title>
          <div>
            <h4 class="headline mb-0">User Details #{{ user.id }}</h4>
          </div>
        </v-card-title>
        <table class="table is-striped">
          <tbody>
            <tr>
              <td>Agent Name</td>
              <td>{{ user.name }}</td>
            </tr>
            <tr>
              <td>Level</td>
              <td>Agent Diamond</td>
            </tr>
            <tr></tr>
            <tr>
              <td>Email</td>
              <td>{{ user.email }}</td>
            </tr>
            <tr>
              <td>Phone</td>
              <td>{{ user.phone || 'N/A'}}</td>
            </tr>
            <tr>
              <td>Address</td>
              <td>{{ user.address }}</td>
            </tr>
            <tr>
              <td>City</td>
              <td>{{ user.city }}</td>
            </tr>
            <tr>
              <td>State</td>
              <td>{{ user.state }}</td>
            </tr>
          </tbody>
        </table>
      </v-card>
      <v-card>
        <v-card-title primary-title>
          <div>
            <h4 class="headline mb-0">Stock Details</h4>
          </div>
        </v-card-title>
        <table class="table is-striped">
          <tbody>
            <tr>
              <td>Total In Stock</td>
              <td>20</td>
            </tr>
            <tr>
              <td>Total Stock Sold</td>
              <td>12</td>
            </tr>
            <tr></tr>
            <tr>
              <td>Total Stock Purchased</td>
              <td>32</td>
            </tr>
          </tbody>
        </table>
      </v-card>
    </v-container>
  </v-content>
</template>
<script>
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      email: "",
      name: "",
      phone: "",
      city: "",
      state: "",
      user: {},
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
      .get("/users/" + this.$route.params.id)
      .then(function(response) {
        // handle success
        self.user = response.data.user;
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
