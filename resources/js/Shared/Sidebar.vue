<template>
  <div
    class="md:left-0 md:block md:fixed md:top-28 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-no-wrap md:overflow-hidden shadow-xl bg-white flex flex-wrap items-center justify-between md:w-64 z-10 py-4 px-6"
  >
    <div
      class="md:flex-col md:items-stretch md:min-h-full md:flex-no-wrap px-0 flex flex-wrap items-center justify-between w-full mx-auto"
    >
      <!-- Collapse -->
      <div
        class="md:flex md:flex-col md:items-stretch md:opacity-100  md:mt-4 md:shadow-none shadow top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-auto items-center flex-1 rounded"
      >
        <!-- Navigation -->
        <ul class="md:flex-col md:min-w-full flex flex-col list-none">
          <jet-nav-link :href="route('dashboard')" :active="route().current('dashboard')">
            <i class="fas fa-home"></i>&nbsp;
            Dashboard
          </jet-nav-link>
        </ul>
        <!-- Divider -->
        <hr class="my-4 md:min-w-full" />
        <!-- Heading -->
        <h6
          class="md:min-w-full text-gray-600 text-xs uppercase font-bold block pt-1 pb-4 no-underline"
        >
          Documentation
        </h6>
        <!-- Navigation -->
        <ul
          class="md:flex-col md:min-w-full flex flex-col list-none md:mb-4"
        >
          <li class="inline-flex">
            <a
              class="text-gray-800 hover:text-gray-600 text-sm block mb-4 no-underline font-semibold"
              href="https://support.lightspeedvt.com"
              ><i class="far fa-file"></i>&nbsp;
              External Docs</a
            >
          </li>
          <li class="inline-flex">
            <jet-nav-link :href="route('articles')" :active="route().current('articles')">
              <i class="far fa-file"></i>&nbsp;
              Interntal Docs
            </jet-nav-link>
          </li>
          
        </ul>
        <hr class="my-4 md:min-w-full" />
        <h6 class="md:min-w-full text-gray-600 text-xs uppercase font-bold block pt-1 pb-4 no-underline">Utilities</h6>
        <ul class="md:flex-col md:min-w-full flex flex-col list-none">
          <li class="items-center">
            <jet-nav-link :href="route('skillshop')" :active="route().current('skillshop')">
              <i class="fas fa-store-alt"></i>&nbsp;
              Skillshop
            </jet-nav-link>
          </li>
          
          <li class="items-center">
            <a
              class="text-gray-800 hover:text-pink-600 text-xs uppercase py-3 font-bold block"
              href="https://crm.lightspeedvt.com"
              ><i class="fas fa-chart-bar"></i>&nbsp;
              LSVT CRM</a
            >
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>
<script>
//import NotificationDropdownComponent from "./NotificationDropdown.vue";
//import UserDropdownComponent from "./UserDropdown.vue";
import JetNavLink from "@/Jetstream/NavLink";
export default {
  data() {
    return {};
  },
  components: {
    JetNavLink
  }
};
</script>