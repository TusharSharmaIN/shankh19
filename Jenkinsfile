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
		sh 'docker exec shankhnaad.org rm -rR /var/www/shankhnaad.org/public_html/*'
		sh 'docker exec shankhnaad.org rm -rR /var/www/shankhnaad.org/public_html/.htaccess'
		sh 'echo COPYING NEW FILES...'
        sh 'docker cp . shankhnaad.org:/var/www/shankhnaad.org/public_html/'
		sh 'echo DEPLOYMENT COMPLETE'
      }
    }
  }
}
