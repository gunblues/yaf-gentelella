module.exports = function (grunt) {
    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        jshint: {
            options: {
                node: true,
                browser: true,
                esnext: true,
                bitwise: true,
                camelcase: false,
                curly: false,
                eqeqeq: true,
                immed: true,
                indent: 4,
                latedef: true,
                newcap: true,
                noarg: true,
                quotmark: false, 
                regexp: true,
                undef: true,
                unused: false,
                strict: false,
                trailing: true,
                smarttabs: true,
                maxdepth: 5,
                freeze: true,
                evil: true,
                sub: true,
                white: true,
                globals: {
                    jQuery: false,
                    $: false,
                    _: false,
                    app: false,
                    MyUtil: false,
                    LibCtrl: false,
                },
                force: false,
                ignores: []
            },
            files: {
                src: [
                    'app/assets/js/library/MyUtil.js',
                    'app/assets/js/controllers/*.js'
                ],
            }
        },
        uglify: {
            options: {
                compress: {
                    drop_console: true
                }, 
                mangle: true,
                beautify: false 
            },    
            build: {
                files: [
                {
                    src: [
                        'app/assets/vendors/datatables.net/js/jquery.dataTables.min.js',
                        'app/assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js',
                        'app/assets/vendors/datatables.net-buttons/js/dataTables.buttons.min.js',
                        'app/assets/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js',
                        'app/assets/vendors/datatables.net-buttons/js/buttons.flash.min.js',
                        'app/assets/vendors/datatables.net-buttons/js/buttons.html5.min.js',
                        'app/assets/vendors/datatables.net-buttons/js/buttons.print.min.js',
                        'app/assets/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js',
                        'app/assets/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js',
                        'app/assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js',
                        'app/assets/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js',
                        'app/assets/vendors/datatables.net-scroller/js/dataTables.scroller.min.js'
                    ],
                    dest: 'app/assets/js/datatables.js'
                },
                {
                    src: [
                        'app/assets/vendors/Flot/jquery.flot.js',
                        'app/assets/vendors/Flot/jquery.flot.pie.js',
                        'app/assets/vendors/Flot/jquery.flot.time.js',
                        'app/assets/vendors/Flot/jquery.flot.stack.js',
                        'app/assets/vendors/Flot/jquery.flot.resize.js',
                        'app/assets/vendors/flot.orderbars/js/jquery.flot.orderBars.js',
                        'app/assets/vendors/flot-spline/js/jquery.flot.spline.min.js',
                        'app/assets/vendors/flot.curvedlines/curvedLines.js'
                    ],
                    dest: 'app/assets/js/flot.js'
                },
                {
                    src: [
                        'app/assets/vendors/jquery-pjax/jquery.pjax.js',
                        'app/assets/js/library/MyUtil.js',
                        'app/assets/js/controllers/LibCtrl.js',
                        'app/assets/js/controllers/PageInitCtrl.js'
                    ],
                    dest: 'app/assets/js/app.js'
                }
                ]
            }
        },
        compass: {
            options: {
                config: 'config/compass.rb'
            },
            dev: {
                options: {
                    environment: 'development',
                    outputStyle: 'expanded',
                    relativeAssets: true
                }
            }
        },
        cssmin: {
            dev: {
                expand: true,
                files: {
                    "app/assets/css/library.css": [
                    ]
                }
            }
        },
        cachebreaker: {
            dev: {
                options: {
                    match: ['app.css', 'app.js']
                },
                files: {
                    src: ['app/application/views/index/index.phtml']
                }
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-compass');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-cache-breaker');

    grunt.registerTask('default', ['jshint', 'compass', 'uglify', 'cssmin', 'cachebreaker']);
    grunt.registerTask('production', ['jslint', 'compass', 'uglify', 'cssmin', 'cachebreaker']);

};
