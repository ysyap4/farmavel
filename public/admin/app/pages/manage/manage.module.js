/**
 * @author v.lugovsky
 * created on 16.12.2015
 */
(function () {
  'use strict';

  angular.module('BlurAdmin.pages.manage', [])
    .config(routeConfig);

  /** @ngInject */
  function routeConfig($stateProvider, $urlRouterProvider) {
    $stateProvider
        .state('manage', {
          url: '/manage',
          template : '<ui-view  autoscroll="true" autoscroll-body-top></ui-view>',
          abstract: true,
          controller: 'ManageCtrl',
          title: 'Manage',
          sidebarMeta: {
            icon: 'ion-grid',
            order: 500,
          },
        }).state('manage.user', {
          url: '/user',
          templateUrl: adminPath + '/app/pages/manage/user/user_index.blade.php',
          title: 'User',
          sidebarMeta: {
            order: 0,
          },
        }).state('manage.smart', {
          url: '/smart',
          templateUrl: adminPath + '/app/pages/manage/smart/tables.html',
          title: 'Smart Tables',
          sidebarMeta: {
            order: 100,
          },
        });
    $urlRouterProvider.when('/manage','/manage/basic');
  }

})();
