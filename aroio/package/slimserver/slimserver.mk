################################################################################
#
# slimserver
#
################################################################################

SLIMSERVER_VERSION = 6e530508d14cce84d7eae8c08799198eab0639bf
SLIMSERVER_SITE = $(call github,Logitech,slimserver,$(SLIMSERVER_VERSION))

SLIMSERVER_LICENSE = GPL, 
SLIMSERVER_LICENSE_FILES = Licenses.txt
SLIMSERVER_DEPENDENCIES = \
	libmediascan \
	perl expat \
	perl-anyevent \
	perl-archive-zip \
	perl-audio-cuefile-parser \
	perl-audio-scan \
	perl-cgi \
	perl-carp-clan \
	perl-class-accessor-chained \
	perl-class-accessor-fast \
	perl-class-data-inheritable \
	perl-class-c3-xs \
	perl-class-inspector \
	perl-class-xsaccessor \
	perl-common-sense \
	perl-compress-raw-zlib \
	perl-context-preserve \
	perl-data-dump \
	perl-data-page \
	perl-data-uriencode \
	perl-dbd-mysql \
	perl-dbd-sqlite \
	perl-dbix-class \
	perl-digest-sha1 \
	perl-encode-detect \
	perl-extutils-cbuilder \
	perl-ev \
	perl-exporter-lite \
	perl-font-freetype \
	perl-file-bom \
	perl-file-next \
	perl-file-readbackwards \
	perl-file-slurp \
	perl-file-which \
	perl-html-parser \
	perl-html-tagset \
	perl-http-daemon \
	perl-http-message \
	perl-http-cookies \
	perl-image-scale \
	perl-io-aio \
	perl-io-interface \
	perl-io-socket-ssl \
	perl-io-string \
	perl-json-xs \
	perl-json-xs-versiononeandtwo \
	perl-libwww-perl \
	perl-linux-inotify2 \
	perl-log-log4perl \
	perl-lwp-mediatypes \
	perl-mp3-cut-gapless \
	perl-net-http \
	perl-network-ipv4addr \
	perl-path-class \
	perl-proc-background \
	perl-soap-lite \
	perl-sql-abstract \
	perl-sql-abstract-limit \
	perl-sub-name \
	perl-sub-uplevel \
	perl-template-toolkit \
	perl-text-unidecode \
	perl-tie-cache-lru \
	perl-tie-cache-lru-expires \
	perl-tie-regexphash \
	perl-timedate \
	perl-tree-dag-node \
	perl-uri \
	perl-uri-find \
	perl-uuid-tiny \
	perl-xml-parser \
	perl-xml-simple \
	perl-yaml-libyaml

SLIMSERVER_INSTALL_EXTENSIONS = pl txt html dat conf
SLIMSERVER_INSTALL_DIRECTORIES = Graphics HTML IR lib MySQL Slim SQL

define SLIMSERVER_INSTALL_TARGET_CMDS
	$(INSTALL) -d -m 0755 $(TARGET_DIR)/opt/slimserver
	for ext in $(SLIMSERVER_INSTALL_EXTENSIONS); do \
		cp -a $(@D)/*.$${ext} $(TARGET_DIR)/opt/slimserver/ \
	;done
	for d in $(SLIMSERVER_INSTALL_DIRECTORIES); do \
		cp -ar $(@D)/$${d} $(TARGET_DIR)/opt/slimserver/ \
	;done
	$(INSTALL) -d -m 0755 $(TARGET_DIR)/opt/slimserver/CPAN
	#for f in $(@D)/CPAN/*; do \
	#	echo `basename $$f`; \
	#	if [ `basename $$f` != arch ]; then \
	#		cp -ar $$f $(TARGET_DIR)/opt/slimserver/CPAN \
	#	;fi \
	#;done
	cp -ar $(@D)/CPAN/DBIx $(TARGET_DIR)/opt/slimserver/CPAN/
	cp -ar $(@D)/CPAN/Media $(TARGET_DIR)/opt/slimserver/CPAN/
endef

$(eval $(generic-package))
