#/bin/bash
####
# Replace version in files.
# Get version from package.json
##
PACKAGE_VERSION=$(sed -nr 's/^\s*\"version": "([0-9]{1,}\.[0-9]{1,}.*)",$/\1/p' package.json)

src1="\(Version:[ \t]*\)[0-9]\{1,\}\.[0-9]\{1,\}.*$";
dst1="\1$PACKAGE_VERSION";
sed --in-place "s#$src1#$dst1#g" ./style.css