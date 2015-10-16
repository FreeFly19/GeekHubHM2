var app = angular.module('app', []);

app.config(function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
});

app.controller('mainController', function($scope, $http){
    $scope.show = function(groupId){
        $http.get('/group/'+groupId+'/posts').then(function(response){
            $scope.posts = response.data;
        }, function(){
            alert('Виникла помилка, спробуйте іншу групу!');
        });
    };
    $scope.show($scope.groupId=30111409);

});