module.exports = function (grunt) {
  require('load-grunt-tasks')(grunt);

  grunt.initConfig({
    jsDev: 'library/dev/js/',
    jsPub: 'library/js/',
    cssDev: 'library/dev/scss/',
    cssPub: 'library/css/',
    pkg: grunt.file.readJSON('package.json'),

    concat: {
      dist: {
        src: ['<%= jsDev %>*.js'],
        dest: '<%= jsPub %>scripts.js'
      }
    },

    jshint: {
      beforeconcat: ['<%= jsDev %>*.js'],
      afterconcat: ['<%= jsPub %>scripts.js']
    },

    uglify: {
      options: {
        banner: '/*! <%= pkg.name %> <%=grunt.template.today("dd-mm-yyyy") %> */\n'
      },
      dist: {
        files: {
          '<%= jsPub %>scripts.min.js': ['<%= concat.dist.dest %>']
        }
      }
    },

    sass: {
      dist: {
        options: {
          style: 'expanded'
        },
        files: {
          '<%= cssDev %>style.css': '<%= cssDev %>style.scss',
          '<%= cssDev %>login.css': '<%= cssDev %>login.scss'
        }
      }
    },

    postcss: {
      options: {
        map: true, // inline sourcemaps
        processors: [
          require('autoprefixer')({browsers: 'last 2 versions'}), // add vendor prefixes
          require('cssnano')() // minify the result
        ]
      },
      dist: {
        src: '<%= cssDev %>style.css',
        dest: '<%= cssPub %>style.min.css'
      },
      admin: {
        src: '<%= cssDev %>login.css',
        dest: '<%= cssPub %>login.min.css'
      }
    },

    watch: {
      files: ['<%= jsDev %>*.js', '<%= cssDev %>**/*.scss'],
      tasks: ['concat', 'jshint', 'uglify', 'sass', 'postcss']
    },

  });

  grunt.registerTask('default', [
    'concat',
    'jshint',
    'uglify',
    'sass',
    'postcss',
    'watch'
  ]);
};