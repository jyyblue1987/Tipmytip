app = angular.module('app',    [
        'ui.bootstrap',
    ]);

app.controller('SignUpController', function($scope, $http) {
     function initData() {

        $scope.user = {};
         $scope.user.gender = "Male";
        $scope.dateOptions = {
            dateDisabled: disabled,
            formatYear: 'yy',
            maxDate: new Date(2020, 5, 22),
            startingDay: 1
        };

        $http.get('/location')
            .then(function(response) {
                $scope.countrylist = response.data.countrylist;
                $scope.user.national_id = $scope.countrylist[0].id;
                $scope.user.country_id = $scope.countrylist[0].id;
                $scope.user.country_id1 = $scope.countrylist[0].id;
                $scope.user.country_id2 = $scope.countrylist[0].id;
                $scope.user.country_id3 = $scope.countrylist[0].id;
                $scope.user.country_id4 = $scope.countrylist[0].id;


                $scope.onSelectCountry($scope.user.country_id, 0);
                $scope.onSelectCountry($scope.user.country_id, 1);
                $scope.onSelectCountry($scope.user.country_id, 2);
                $scope.onSelectCountry($scope.user.country_id, 3);
                $scope.onSelectCountry($scope.user.country_id, 4);
            }).catch(function(response) {
            })
            .finally(function() {
            });
    }

    initData();

    $scope.onSelectCountry = function(country_id, num) {
        $http.get('/city/' + country_id)
            .then(function(response) {
                switch (num) {
                    case 0:
                        $scope.citylist0 = response.data.citylist;
                        $scope.user.city_id = $scope.citylist0[0].id;
                        break;
                    case 1:
                        $scope.citylist1 = response.data.citylist;
                        $scope.user.city_id1 = $scope.citylist1[0].id;
                        break;
                    case 2:
                        $scope.citylist2 = response.data.citylist;
                        $scope.user.city_id2 = $scope.citylist2[0].id;
                        break;
                    case 3:
                        $scope.citylist3 = response.data.citylist;
                        $scope.user.city_id3 = $scope.citylist3[0].id;
                        break;
                    case 4:
                        $scope.citylist4 = response.data.citylist;
                        $scope.user.city_id4 = $scope.citylist4[0].id;
                        break;
                }

             }).catch(function(response) {
            })
            .finally(function() {
            });
    }

    $scope.open = function() {
        $scope.opened = true;
    };

    // Disable weekend selection
    function disabled(data) {
        //var date = data.date,
        //    mode = data.mode;
        //return mode === 'day' && (date.getDay() === 0 || date.getDay() === 6);
        return false;
    }

    $scope.submit = function() {
        console.log($scope.user);

        $http({
            method: 'POST',
            url: '/createaccount',
            data: $scope.user,
            headers: {'Content-Type': 'application/json; charset=utf-8'}
        })
            .then(function(response) {
                console.log(response.data);
            }).catch(function(response) {
                console.error('Gists error', response.status, response.data);
            })
            .finally(function() {
                $scope.isLoading = false;
            });
    }

});
