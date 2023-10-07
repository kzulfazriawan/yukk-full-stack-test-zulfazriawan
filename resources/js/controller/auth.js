const LoginController = ($scope, $window, $cookies, Http) => {
    $scope.form = {
        is_login: true,
        login: {
            email: null,
            password: null,
        },
        register: {
            name: null,
            email: null,
            password: null,
            password_confirmation: null,
            agreement: false,
        }
    }

    $scope.success = {
        login: {
            alert: null,
        },
        register: {
            alert: null,
        }
    }

    $scope.error = {
        login: {
            alert: null,
            email: null,
            password: null,
        },
        register: {
            alert: null,
            name: null,
            email: null,
            password: null,
            password_confirmation: null
        }
    }

    $scope.toggle = () => {
        $scope.form.is_login = !$scope.form.is_login;
    }

    $scope.submit = () => {
        $scope.success = {
            login: {
                alert: null,
            },
            register: {
                alert: null,
            }
        }
    
        $scope.error = {
            login: {
                alert: null,
                email: null,
                password: null,
            },
            register: {
                alert: null,
                name: null,
                email: null,
                password: null,
                password_confirmation: null
            }
        }

        let target = ($scope.form.is_login) ? '/api/v1/login': '/api/v1/register';
        let data   = ($scope.form.is_login) ? $scope.form.login : $scope.form.register;

        Http.sendAsJson('POST', target, {data: data}).then(
            (response) => {
                let data = response.data;
                console.log($scope.form.is_login);
                
                if($scope.form.is_login){
                    $scope.success.login.alert = 'Authentication Granted! Welcome to Application';
                    $cookies.put('token', data.token);

                    setTimeout(() => {
                        $window.location.href = '/';
                    }, 750);
                } else {
                    $scope.success.register.alert = 'Congratulations! You\'ve been Created an Account';
                    setTimeout(() => {
                        $window.location.href = '/verification?param_=' + btoa(data.verify + '|' + data.email);
                    }, 750);
                }
            },
            (response) => {
                let data = response.data;

                if($scope.form.is_login){
                    $scope.error.login.alert = data.message;

                    if(data.errors)
                        Object.keys(data.errors).forEach(i => { $scope.error.login[i] = data.errors[i][0] });
                } else {
                    $scope.error.register.alert = data.message;

                    if(data.errors)
                        Object.keys(data.errors).forEach(i => { $scope.error.register[i] = data.errors[i][0] });
                }
            }
        )
    }
}

export {LoginController}