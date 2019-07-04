<template>
  <v-content>
    <v-container>
      <v-card>
        <v-card-title primary-title>
          <div>
            <h4 class="headline mb-0">Inbox</h4>
          </div>
        </v-card-title>
        <table class="table is-striped">
          <thead>
            <tr>
              <td>Date / Time</td>
              <td>Title</td>
              <td>From</td>
              <td>Action</td>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(p, index) in orders" :key="index">
              <td>{{ p.created_at }}</td>
              <td>Annoucement</td>
              <td>HQ</td>
              <td>
                <a @click="openDialog()" href="#">View</a>
              </td>
            </tr>
          </tbody>
        </table>
      </v-card>
    </v-container>
    <v-dialog v-model="dialog" max-width="290">
      <v-card>
        <v-card-title class="headline">Annoucement</v-card-title>

        <v-card-text>Your application will be submitted to your team leader for review.</v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>

          <v-btn color="green darken-1" flat="flat" @click="dialog = false">Close</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
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
      province: "",
      downline: [],
      downline_id: "",
      dialog: false
    };
  },
  created() {
    this.$store.dispatch("loadOrders");
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
  computed: {
    ...mapGetters({
      orders: "orders"
    })
  },
  methods: {
    openDialog: function() {
      this.dialog = true;
    }
  }
};
</script>
