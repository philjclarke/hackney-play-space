(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["templates"],{2164:function(e,t,n){var a=n("cae7");function i(e,t,n){var i=-1,r=e.criteria,s=t.criteria,o=r.length,c=n.length;while(++i<o){var l=a(r[i],s[i]);if(l){if(i>=c)return l;var p=n[i];return l*("desc"==p?-1:1)}}return e.index-t.index}e.exports=i},"6a5c":function(e,t,n){var a=n("7948"),i=n("badf"),r=n("97d3"),s=n("d4b2"),o=n("b047"),c=n("2164"),l=n("cd9d");function p(e,t,n){var p=-1;t=a(t.length?t:[l],o(i));var u=r(e,function(e,n,i){var r=a(t,function(t){return t(e)});return{criteria:r,index:++p,value:e}});return s(u,function(e,t){return c(e,t,n)})}e.exports=p},"93c6":function(e,t,n){var a=n("6a5c"),i=n("6747");function r(e,t,n,r){return null==e?[]:(i(t)||(t=null==t?[]:[t]),n=r?void 0:n,i(n)||(n=null==n?[]:[n]),a(e,t,n))}e.exports=r},"9fe3":function(e,t,n){"use strict";var a=n("ad51"),i=n.n(a);i.a},ad51:function(e,t,n){},b0d4:function(e,t,n){"use strict";n.r(t);var a=function(){var e=this,t=e.$createElement,n=e._self._c||t;return e.reachedCampaignLimit?n("templates-limit-exceeded"):n("core-page",{attrs:{title:"Select a Campaign Type:",classes:"templates-wrapper"}},[n("common-alerts",{attrs:{alerts:e.alerts}}),n("div",{staticClass:"templates-content"},[n("templates-types"),n("templates-filters"),n("div",{staticClass:"omapi-content-area"},[n("templates-upsell-alerts"),e.hasTemplates?n("div",{staticClass:"omapi-template-listing-wrap"},[n("templates-grid",{attrs:{templates:e.selectedTemplates}}),e.isLoading?n("svg-loading",{style:{margin:"0 auto"}}):e._e()],1):e.isLoading?n("div",{staticClass:"archie-loader-wrapper"},[n("div",[n("core-loading",{staticClass:"loader"})],1)]):n("div",{staticClass:"no-templates-available"},[n("core-alert",{attrs:{type:e.validType?"info":"warn"}},[n("div",{staticClass:"alert-message"},[e._v("\n\t\t\t\t\t\t"+e._s(e.noTemplatesMessage)+"\n\t\t\t\t\t")])])],1)],1)],1),n("campaigns-modal-create-campaign"),n("templates-modal-not-connected"),n("templates-modal-no-access")],1)},i=[],r=(n("8e6e"),n("456d"),n("ac6a"),n("7f7f"),n("386d"),n("55dd"),n("6762"),n("2fdb"),n("7514"),n("75fc")),s=n("bd86"),o=n("9b02"),c=n.n(o),l=n("93c6"),p=n.n(l),u=n("8103"),d=n.n(u),m=n("9c6cf"),f=n("2f62");function v(e,t){var n=Object.keys(e);return Object.getOwnPropertySymbols&&n.push.apply(n,Object.getOwnPropertySymbols(e)),t&&(n=n.filter(function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable})),n}function h(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?v(n,!0).forEach(function(t){Object(s["a"])(e,t,n[t])}):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):v(n).forEach(function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))})}return e}var g=Object(f["a"])("templates"),b=g.mapState,y=g.mapActions,w=g.mapGetters,L={created:function(){var e=this;this.listenApiLoaded(),document.addEventListener("om.Main.getCampaigns",m["e"]),document.addEventListener("om.Campaigns.init",m["b"]),document.addEventListener("om.Optin.init",m["f"]),document.addEventListener("om.Campaign.afterShow",m["d"]),document.addEventListener("om.Campaign.startClose",m["c"]),this.$store.subscribe(function(t,n){var a=["templates/setLoadingPreview","templates/setPreviewing"];-1===a.indexOf(t.type)&&(Object(m["a"])(),e.$store.commit("templates/setLoadingPreview",""),e.$store.commit("templates/setPreviewing",""))}),this.$store.dispatch("campaigns/fetchDashboard"),this.loadApi()},beforeDestroy:function(){document.removeEventListener("om.Main.getCampaigns",m["e"]),document.removeEventListener("om.Campaigns.init",m["b"]),document.removeEventListener("om.Optin.init",m["f"]),document.removeEventListener("om.Campaign.afterShow",m["d"]),document.removeEventListener("om.Campaign.startClose",m["c"])},computed:h({},b(["activeType","search","sort","popular","templates"]),{},w(["typePermitted","featured","filters","filterGamified","validType"]),{alerts:function(){var e=Object(r["a"])(this.$get("$store.state.alerts",[]));return e.concat(this.$get("$store.state.campaigns.alerts",[]))},isLoading:function(){return this.$store.getters.isLoading("templates")},popularTemplates:function(){var e=this.popular[this.activeType];return e&&e.length?this.order(e):[]},featuredTemplates:function(){var e=this.featured[this.activeType];return e&&e.length?this.order(e):[]},showableTemplates:function(){var e=this,t=function(t,n){return!e.filters[t].length||!e.filters[t].find(function(e){return!n.includes(e)})},n=["popular","featured"].includes(this.sort)?"".concat(this.sort,"Templates"):"templates",a=this[n].filter(function(t){return""===e.search||t.name.toLowerCase().includes(e.search.toLowerCase())}).filter(function(n){var a="mobile"===e.filters.device?n.mobile:!n.mobile;if(!a)return!1;var i=["goals","categories","tags"];return!i.find(function(e){return!t(e,n[e].map(function(e){return e.id}))})});return this.order(a)},selectedTemplates:function(){var e=this;return this.showableTemplates.filter(function(t){return e.filterGamified?t.tags.find(function(e){return 1===e.id}):t.type===e.activeType})},hasTemplates:function(){return this.selectedTemplates.length},shouldShowUpsells:function(){return!!this.$store.getters.connected&&!this.typePermitted(this.activeType)},noTemplatesMessage:function(){return this.validType?"No templates available for your current selection.":"".concat(d()(this.activeType)," is not a valid type. Please select one of the options above.")},reachedCampaignLimit:function(){if(!this.$store.getters.connected)return!1;var e=this.$get("$store.state.campaigns.totalCampaignsCount",0),t=c()(this.$store.getters.userAttribute("limits",{}),"campaigns",10);return e>t}}),mounted:function(){this.fetchTemplateData(),this.$bus.$emit("dashboard-view-mounted","templates")},methods:h({},y(["fetchTemplateData"]),{listenApiLoaded:function(){var e=this,t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"addEventListener";["om.Api.init","om.Main.init","om.Campaigns.init","om.Campaign.init"].forEach(function(n){return document[t](n,e.setApiLoaded)})},loadApi:function(){var e=document.getElementById("omwpapi-templates-apijs");if(!e){var t=document.getElementsByTagName("head")[0]||document.documentElement;e=document.createElement("script"),e.type="text/javascript",e.id="omwpapi-templates-apijs",e.src=this.$urls.apiJs(),e.async=!0,e.dataset.account=56690,e.dataset.user=50374,this.$env.isEnv("production")||(e.dataset.env=this.$env.isEnv("development")?"dev":this.$env.currentEnv),t.appendChild(e)}},setApiLoaded:function(e){this.listenApiLoaded("removeEventListener"),this.$store.commit("templates/apiLoaded")},applyFilters:function(e){this.$bus.$emit("applied-bulk-filter"),this.$store.commit("templates/appliedFilters",e)},order:function(e){var t=this;return p()(e,function(e){return"recent"===t.sort?-t.$moment(e.created_at).valueOf():e.name})}})},C=L,$=(n("9fe3"),n("2877")),T=Object($["a"])(C,a,i,!1,null,null,null);t["default"]=T.exports},cae7:function(e,t,n){var a=n("ffd6");function i(e,t){if(e!==t){var n=void 0!==e,i=null===e,r=e===e,s=a(e),o=void 0!==t,c=null===t,l=t===t,p=a(t);if(!c&&!p&&!s&&e>t||s&&o&&l&&!c&&!p||i&&o&&l||!n&&l||!r)return 1;if(!i&&!s&&!p&&e<t||p&&n&&r&&!i&&!s||c&&n&&r||!o&&r||!l)return-1}return 0}e.exports=i},d4b2:function(e,t){function n(e,t){var n=e.length;e.sort(t);while(n--)e[n]=e[n].value;return e}e.exports=n}}]);
//# sourceMappingURL=templates.57ee05ff.js.map