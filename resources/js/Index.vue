<template>
  <!-- <div id="main">
    <header id="header">
      <h1>
        <router-link :to="{name: 'home'}">Laravel Vue SPA</router-link>
      </h1>
      <navigationMenu></navigationMenu>
    </header>
    <div id="content">
      <router-view></router-view>
    </div>
  </div>-->
  <v-app id="inspire" color="#bf1f31">
    <v-navigation-drawer fixed clipped v-model="drawer" app>
      <v-list dense>
        <v-list-tile v-if="!$auth.check()" v-for="item in routes.unlogged" :key="item.text" @click>
          <v-list-tile-action>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>
              <router-link tag="li" :to="item.path">{{ item.text }}</router-link>
            </v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
        <v-list-tile v-if="$auth.check()" v-for="item in routes.user" :key="item.text" @click>
          <v-list-tile-action>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>
              <router-link tag="li" :to="item.path">{{ item.text }}</router-link>
            </v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
        <v-list-tile v-if="$auth.check()">
          <v-list-tile-action>
            <v-icon>power</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title @click="$auth.logout()">Logout</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
        <!-- <navigationMenu></navigationMenu> -->
        <!-- <v-subheader class="mt-3 grey--text text--darken-1">SUBSCRIPTIONS</v-subheader>
        <v-list>
          <v-list-tile v-for="item in items2" :key="item.text" avatar @click="test=true">
            <v-list-tile-avatar>
              <img :src="`https://randomuser.me/api/portraits/men/${item.picture}.jpg`" alt>
            </v-list-tile-avatar>
            <v-list-tile-title v-text="item.text"></v-list-tile-title>
          </v-list-tile>
        </v-list>
        <v-list-tile class="mt-3" @click>
          <v-list-tile-action>
            <v-icon color="grey darken-1">add_circle_outline</v-icon>
          </v-list-tile-action>
          <v-list-tile-title class="grey--text text--darken-1">Browse Channels</v-list-tile-title>
        </v-list-tile>
        <v-list-tile @click>
          <v-list-tile-action>
            <v-icon color="grey darken-1">settings</v-icon>
          </v-list-tile-action>
          <v-list-tile-title class="grey--text text--darken-1">Manage Subscriptions</v-list-tile-title>
        </v-list-tile>-->
      </v-list>
    </v-navigation-drawer>
    <v-toolbar color="#bf1f31" dense fixed clipped-left app>
      <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>

      <v-toolbar-title class="mr-5 align-center">
        <span style="color:white" class="title">MEERACLE</span>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-layout row align-center style="max-width: 650px">
        <!-- <v-text-field
          placeholder="Search..."
          single-line
          append-icon="search"
          :append-icon-cb="() => {}"
          color="white"
          hide-details
        ></v-text-field>-->
      </v-layout>
      <v-btn to="/cart" color="#bf1f31" class="button is-info">
        <span style="color:white" class="icon">
          <i class="fa fa-shopping-cart"></i>
        </span>
        <span style="color:white">({{itemsInCart}})</span>
      </v-btn>
    </v-toolbar>
    <router-view></router-view>
  </v-app>
</template>

<script>
import navigationMenu from "./components/Menu.vue";
import { mapGetters } from "vuex";
export default {
  computed: {
    itemsInCart() {
      let cart = this.$store.getters.cartProducts;
      return cart.reduce((accum, item) => accum + item.quantity, 0);
    }
  },
  data() {
    return {
      //
      bottomNav: "recent",
      routes: {
        // UNLOGGED
        unlogged: [
          { icon: "home", text: "Home", path: "/" },
          {
            text: "Register",
            path: "register",
            icon: "description"
          },
          {
            text: "Login",
            path: "login",
            icon: "lock_open"
          }
        ],

        // LOGGED USER
        user: [
          // {
          //   text: "Dashboard",
          //   path: "dashboard",
          //   icon: "important_devices"
          // },
          { icon: "home", text: "Home", path: "/" },
          { icon: "store", text: "Sell Product", path: "sell" },
          { icon: "shopping_basket", text: "Order Product", path: "buy" },
          { icon: "watch", text: "Merchandise", path: "merchandise" },
          { icon: "people", text: "Genelogy", path: "genelogy" },
          { icon: "history", text: "History", path: "history" }
        ],
        // LOGGED ADMIN
        admin: [
          {
            text: "Dashboard",
            path: "admin.dashboard",
            icon: "trending_up"
          }
        ]
      },
      drawer: false
    };
  },
  props: {
    source: String
  },
  components: {
    navigationMenu
  }
};
</script>