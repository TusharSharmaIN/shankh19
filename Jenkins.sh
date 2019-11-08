echo STOPPING CURRENTLY RUNNING SERVER...
docker exec admin.shankhnaad.org forever stop 0
echo MOVING node_modules to a safe location...
docker exec admin.shankhnaad.org mv /var/www/admin.shankhnaad.org/public_html/node_modules /var/www/admin.shankhnaad.org/
echo DELETING OLD FILES...
docker exec admin.shankhnaad.org rm -rf /var/www/admin.shankhnaad.org/public_html/*
docker exec admin.shankhnaad.org rm -rf /var/www/admin.shankhnaad.org/public_html/.*
echo COPYING NEW FILES...
docker cp . admin.shankhnaad.org:/var/www/admin.shankhnaad.org/public_html/
echo MOVING node_modules back to public_html...
docker exec admin.shankhnaad.org npm rebuild --prefix /var/www/admin.shankhnaad.org/public_html/
docker exec admin.shankhnaad.org npm --prefix /var/www/admin.shankhnaad.org/public_html/ run start
echo DEPLOYMENT COMPLETE