app = angular.module('app',    [
        'ui.bootstrap', 'toaster', 'ngOpenFB'], function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});


app.directive('ngModelOnblur', function() {
    return {
        restrict: 'A',
        require: 'ngModel',
        priority: 1, // needed for angular 1.2.x
        link: function(scope, elm, attr, ngModelCtrl) {
            if (attr.type === 'radio' || attr.type === 'checkbox') return;

            elm.unbind('input').unbind('keydown').unbind('change');
            elm.bind('blur', function() {
                scope.$apply(function() {
                    ngModelCtrl.$setViewValue(elm.val());
                });
            });
        }
    };
});

app.controller('SignUpController', function($scope, $http, ngFB, toaster) {
     function initData() {
         ngFB.init({appId: '1165809443511301'});
         //ngFB.init({appId: '619623278194684'});

        $scope.user = {};
         $scope.user.email = '';
         $scope.user.gender = "Male";
         $scope.em_1=true;
         $scope.em_2=false;
         $scope.em_chk_1 = true;
         $scope.em_1_color = 'color:white';
         $scope.em_chk_1_color = 'color:white';
         $scope.em_pass_1=true;
         $scope.em_pass_1_color = 'color:white';
         $scope.em_pass_2=false;
         $scope.em_pass_chk_1=true;
         $scope.em_pass_chk_1_color = 'color:white';

        $scope.dateOptions = {
            dateDisabled: disabled,
            formatYear: 'yy',
            maxDate: new Date(2020, 5, 22),
            startingDay: 1
        };

        $http.get('/location')
            .then(function(response) {
                $scope.countrylist = response.data.countrylist;

                $scope.nationallist = angular.copy(response.data.countrylist);
                var default_national = {};
                default_national.id = 0;
                default_national.name = "Nationality";
                $scope.nationallist.unshift(default_national);
                $scope.user.national_id = 0;

                var default_country = {};
                default_country.id = 0;
                default_country.name = "Country";
                $scope.countrylist.unshift(default_country);
                $scope.user.country_id = 0;

                $scope.user.national_id = $scope.nationallist[0].id;
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
                var default_city = {};
                default_city.id = 0;
                default_city.name = "City";
                switch (num) {
                    case 0:
                        if(country_id==0) {
                            $scope.citylist0 = [];
                            $scope.citylist0.unshift(default_city);
                            $scope.user.city_id = $scope.citylist0[0].id;
                        }else {
                            $scope.citylist0 = response.data.citylist;
                            $scope.user.city_id = $scope.citylist0[0].id;
                        }
                        break;
                    case 1:
                        if(country_id==0) {
                            $scope.citylist1 = [];
                            $scope.citylist1.unshift(default_city);
                            $scope.user.city_id1 = $scope.citylist1[0].id;
                        }else {
                            $scope.citylist1 = response.data.citylist;
                            $scope.user.city_id1 = $scope.citylist1[0].id;
                        }
                        break;
                    case 2:
                        if(country_id==0) {
                            $scope.citylist2 = [];
                            $scope.citylist2.unshift(default_city);
                            $scope.user.city_id2 = $scope.citylist2[0].id;
                        }else {
                            $scope.citylist2 = response.data.citylist;
                            $scope.user.city_id2 = $scope.citylist2[0].id;
                        }
                        break;
                    case 3:
                        if(country_id==0) {
                            $scope.citylist3 = [];
                            $scope.citylist3.unshift(default_city);
                            $scope.user.city_id3 = $scope.citylist3[0].id;
                        }else {
                            $scope.citylist3 = response.data.citylist;
                            $scope.user.city_id3 = $scope.citylist3[0].id;
                        }
                        break;
                    case 4:
                        if(country_id==0) {
                            $scope.citylist4 = [];
                            $scope.citylist4.unshift(default_city);
                            $scope.user.city_id4 = $scope.citylist4[0].id;
                        }else {
                            $scope.citylist4 = response.data.citylist;
                            $scope.user.city_id4 = $scope.citylist4[0].id;
                        }
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

    $scope.signupFacebook = function() {
        ngFB.login({scope: 'email,public_profile,publish_actions'}).then(
            function(response) {
                console.log(response.authResponse);
                getFacebookProfile();
            },
            function(response, status) {

            });
    }
//check mail address
    $scope.emailchange = function(emailVal) {
        var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
        if(pattern.test(emailVal)){
            $scope.em_1 = true;
            $scope.em_2 = false;
            $scope.em_1_color = 'color:#616060';
        }else{
            $scope.em_1 = false;
            $scope.em_2 = true;
        }
    }

//confirm mail address
    $scope.emailconfirm = function(emailVal,emailConfirm) {
        if(emailVal==emailConfirm){
            $scope.em_chk_1 = true;
            $scope.em_chk_2 = false;
            $scope.em_chk_1_color = 'color:#616060';
        }else{
            $scope.em_chk_1 = false;
            $scope.em_chk_2 = true;
        }
    }
//check password
    $scope.CheckPassword = function(passVal) {

        if(passVal.length>4){
            $scope.em_pass_1 = true;
            $scope.em_pass_2 = false;
        }else{
            $scope.em_pass_1 = false;
            $scope.em_pass_2 = true;
            $scope.em_pass_1_color='color:#616060';
        }
    }

//confirm password
    $scope.ConfirmPassword = function(Original,Result) {
        if(Original==Result){
            $scope.em_pass_chk_1 = true;
            $scope.em_pass_chk_2 = false;
            $scope.em_pass_chk_1_color='color:#616060';
        }else{
            $scope.em_pass_chk_1 = false;
            $scope.em_pass_chk_2 = true;
        }
    }


    function getFacebookProfile(){
        ngFB.api({path: '/me',params: {fields: 'id,name,email,first_name,last_name,gender'}}).then(
            function(user) {
                $scope.user = user;
                if( user.gender = 'male')
                    $scope.user.gender = 'Male';
                else if( user.gender = 'female')
                    $scope.user.gender = 'Female';
                $scope.confirm_email = user.email;
            }
        );
    }
    // Disable weekend selection
    function disabled(data) {
        var date = data.date,
            mode = data.mode;

        var today = new Date();

        return mode === 'day' && (date > today);
        //return false;
    }

    function getObjectFromArray(objarray, key, value) {
        var ret = {};
        ret.key = '';
        for(var i = 0; i < objarray.length; i++)
        {
            if( objarray[i][key] == value )
            {
                ret = objarray[i];
                break;
            }
        }

        return ret;
    }


    $scope.submit = function() {
        console.log($scope.user);

        var request = angular.copy($scope.user);

        if( request.email != $scope.confirm_email )
        {
            toaster.pop('error', 'Validation Error', 'Email does not match');
            return;
        }

        if( request.password != $scope.confirm_password )
        {
            toaster.pop('error', 'Validation Error', 'Password does not match');
            return;
        }

        request.date_of_birth = moment(request.date_of_birth).format('DD/MM/YYYY');
        if( request.gender == 'Other' && request.custom_gender)
            request.gender = request.custom_gender;


        request.country = getObjectFromArray($scope.countrylist, 'id', request.country_id).name;
        request.national = getObjectFromArray($scope.countrylist, 'id', request.national_id).name;

        $http({
            method: 'POST',
            url: '/createaccount',
            data: request,
            headers: {'Content-Type': 'application/json; charset=utf-8'}
        })
            .then(function(response) {
                var data = response.data;
                if( data.code == 200 )
                    toaster.pop('success', 'Sign up Page', data.message);
                else
                    toaster.pop('error', 'Sign up Page', data.message);
                console.log(response.data);
            }).catch(function(response) {
                toaster.pop('error', 'Sign up Page', 'Account is fail to create');
                console.error('Gists error', response.status, response.data);
            })
            .finally(function() {
                $scope.isLoading = false;
            });
    }

});
