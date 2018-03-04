/**
 * @author v.lugovsky
 * created on 16.12.2015
 */
(function () {
  'use strict';

  angular.module('BlurAdmin.pages', [
    'ui.router',


    'BlurAdmin.pages.dashboard',
    'BlurAdmin.pages.ui',
    'BlurAdmin.pages.components',
    'BlurAdmin.pages.form',
    'BlurAdmin.pages.tables',
    'BlurAdmin.pages.charts',
    'BlurAdmin.pages.maps',
    'BlurAdmin.pages.profile',


  ])
      .config(routeConfig);

  /** @ngInject */
  function routeConfig($urlRouterProvider, baSidebarServiceProvider, $stateProvider) {
    $urlRouterProvider.otherwise('/dashboard');

    $stateProvider
        .state('manage', {
          url: '/manage',
          template : '<ui-view  autoscroll="true" autoscroll-body-top></ui-view>',
          abstract: true,
          controller: 'ManageCtrl',
          title: 'Manage',
          sidebarMeta: {
            icon: 'ion-grid',
            order: 800,
          },
        }).state('manage.user', {
          url: '/user',
          templateUrl: adminPath + '/app/pages/manage/user/user_index.html',
          title: 'User',
          sidebarMeta: {
            order: 0,
          },
        });

    baSidebarServiceProvider.addStaticItem({
      title: 'Pages',
      icon: 'ion-document',
      subMenu: [{
        title: 'Sign In',
        fixedHref: 'auth.blade.php',
        blank: true
      }, {
        title: 'Sign Up',
        fixedHref: 'reg.html',
        blank: true
      }, {
        title: 'User Profile',
        stateRef: 'profile'
      }, {
        title: '404 Page',
        fixedHref: '404.html',
        blank: true
      }]
    });
    baSidebarServiceProvider.addStaticItem({
      title: 'Menu Level 1',
      icon: 'ion-ios-more',
      subMenu: [{
        title: 'Menu Level 1.1',
        disabled: true
      }, {
        title: 'Menu Level 1.2',
        subMenu: [{
          title: 'Menu Level 1.2.1',
          disabled: true
        }]
      }]
    });

    // baSidebarServiceProvider.addStaticItem({
    //   title: 'Manage',
    //   icon: 'ion-clipboard',
    //   subMenu: [{
    //     title: 'User',
    //     fixedHref: 'auth.blade.php',
    //     blank: true
    //   }, {
    //     title: 'Drugs',
    //     fixedHref: 'reg.html',
    //     blank: true
    //   }, {
    //     title: 'Illegal Drugs Report',
    //     stateRef: 'profile'
    //   }, {
    //     title: 'Appointment',
    //     fixedHref: '404.html',
    //     blank: true
    //   }]
    // });
  }

})();
