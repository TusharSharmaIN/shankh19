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
        sh 'echo DELETING OLD FILES...'
        sh 'docker exec admin.shankhnaad.org cd /var/www/admin.shankhnaad.org/public_html/ && rm -rf * .*'
        sh 'echo COPYING NEW FILES...'
        sh 'docker cp . admin.shankhnaad.org:/var/www/admin.shankhnaad.org/public_html/'
        sh 'docker exec admin.shankhnaad.org cd /var/www/admin.shankhnaad.org/public_html/ && npm start'
        sh 'echo DEPLOYMENT COMPLETE'
      }
    }
  }
}