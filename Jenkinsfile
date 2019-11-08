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
        sh './myscript.sh'
        sh 'echo STOPPING CURRENTLY RUNNING SERVER...'
        //sh 'docker exec admin.shankhnaad.org forever stop 0'
        sh 'echo MOVING node_modules to a safe location...'
        sh 'docker exec admin.shankhnaad.org mv /var/www/admin.shankhnaad.org/public_html/node_modules /var/www/admin.shankhnaad.org/'
        sh 'echo DELETING OLD FILES...'
        sh 'docker exec admin.shankhnaad.org rm -rf /var/www/admin.shankhnaad.org/public_html/*'
        sh 'docker exec admin.shankhnaad.org rm -rf /var/www/admin.shankhnaad.org/public_html/.*'
        sh 'echo COPYING NEW FILES...'
        sh 'docker cp . admin.shankhnaad.org:/var/www/admin.shankhnaad.org/public_html/'
        sh 'echo MOVING node_modules back to public_html...'
        sh 'docker exec admin.shankhnaad.org npm rebuild --prefix /var/www/admin.shankhnaad.org/public_html/'
        sh 'docker exec admin.shankhnaad.org npm --prefix /var/www/admin.shankhnaad.org/public_html/ run start'
        sh 'echo DEPLOYMENT COMPLETE'
      }
    }
  }
}