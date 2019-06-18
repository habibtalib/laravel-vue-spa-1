<template>
  <v-content>
    <v-container>
      <v-card>
        <v-card-title primary-title>
          <div>
            <h4 class="headline mb-0">Manage Orders</h4>
          </div>
        </v-card-title>
        <table class="table is-striped">
          <thead>
            <tr>
              <td>Buyer Name</td>
              <td>Date / Time</td>
              <td>Total (RM)</td>
              <td>Status</td>
              <td>Action</td>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(order, index) in orders" :key="index">
              <td>{{ order.user_id }}</td>
              <td>{{ order.created_at }}</td>
              <td>{{ order.total }}</td>
              <td>{{ order.status }}</td>
              <td>
                <a :href="'/order/'+order.id">View</a>
              </td>
            </tr>
          </tbody>
        </table>
      </v-card>
    </v-container>
  </v-content>
</template>
<script>
import axios from "axios";
import { mapGetters, mapActions } from "vuex";
export default {
  computed: {
    ...mapGetters({
      orders: "orders"
    })
  },
  created() {
    this.$store.dispatch("loadOrders");
  },
  data() {
    return {
      valid: true,
      url: "",
      serial: "",
      product: "",
      store: 0
    };
  },
  methods: {
    ...mapActions(["addToCart"])
  }
};
</script>
