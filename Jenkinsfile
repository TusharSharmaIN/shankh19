pipeline {
  agent any
  stages {
    stage('--BUILD--'){
      steps {
        sh 'echo "BUILD COMPLETE"' 
      }
    }
    stage('--DEPLOY--') {
      steps {
        sh 'echo STOPPING CURRENTLY RUNNING SERVER...'
        sh 'forever stop 0'
        sh 'echo DELETING OLD FILES...'
        sh 'docker exec admin.shankhnaad.org "ls -a /var/www/admin.shankhnaad.org/public_html/ | grep -v node_modules | xargs rm -rf"'
        sh 'echo COPYING NEW FILES...'
        sh 'docker cp . admin.shankhnaad.org:/var/www/admin.shankhnaad.org/public_html/'
        sh 'docker exec admin.shankhnaad.org npm rebuild --prefix /var/www/admin.shankhnaad.org/public_html/'
        sh 'docker exec admin.shankhnaad.org npm --prefix /var/www/admin.shankhnaad.org/public_html/ run start'
        sh 'echo DEPLOYMENT COMPLETE'
      }
    }
  }
}