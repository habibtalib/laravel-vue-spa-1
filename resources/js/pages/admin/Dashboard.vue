<template>
  <v-content class="container">
    <v-container style="position: relative;top: 13%;" class="text-xs-center">
      <v-card>
        <h3>Admin Dashboard</h3>
        <p></p>
      </v-card>
      <v-card>
        <div class="card-header">User Listing</div>
        <div class="card-body">
          <userList></userList>
        </div>
      </v-card>
    </v-container>
  </v-content>
</template>

<script>
import userList from "../../components/user-list.vue";
export default {
  mounted() {
    //
  },
  components: {
    userList
  }
};
</script>
