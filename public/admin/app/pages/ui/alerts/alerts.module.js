/**
 * @author v.lugovsky
 * created on 16.12.2015
 */
(function () {
  'use strict';

  angular.module('BlurAdmin.pages.ui.alerts', [])
      .config(routeConfig);

  /** @ngInject */
  function routeConfig($stateProvider) {
    $stateProvider
        .state('ui.alerts', {
          url: '/alerts',
          templateUrl: adminPath + '/app/pages/ui/alerts/alerts.html',
          title: 'Alerts',
          sidebarMeta: {
            order: 500,
          },
        });
  }

})();
