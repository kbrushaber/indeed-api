var jobControllers = angular.module('jobControllers', ['ngAnimate']);

jobControllers.controller('ListController', ['$scope', '$http', function($scope, $http) {
  $http.get('data/search.json').success(function(data) {
    $scope.jobs = data;
    $scope.jobOrder = 'jobtitle';
  });
}]);

jobControllers.controller('DetailsController', ['$scope', '$http','$routeParams', function($scope, $http, $routeParams) {
  $http.get('data/search.json').success(function(data) {
    $scope.jobs = data;
    $scope.whichItem = $routeParams.itemId;

    if ($routeParams.itemId > 0) {
      $scope.prevItem = Number($routeParams.itemId)-1;
    } else {
      $scope.prevItem = $scope.jobs.length-1;
    }

    if ($routeParams.itemId < $scope.jobs.length-1) {
      $scope.nextItem = Number($routeParams.itemId)+1;
    } else {
      $scope.nextItem = 0;
    }

  });
}]);





