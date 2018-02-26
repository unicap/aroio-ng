################################################################################
#
# perl-dbd-mysql
#
################################################################################

PERL_DBD_MYSQL_VERSION = 4.046
PERL_DBD_MYSQL_SOURCE = DBD-mysql-$(PERL_DBD_MYSQL_VERSION).tar.gz
PERL_DBD_MYSQL_SITE = $(BR2_CPAN_MIRROR)/authors/id/C/CA/CAPTTOFU
PERL_DBD_MYSQL_DEPENDENCIES = host-perl-dbi perl-dbi mysql openssl
PERL_DBD_MYSQL_LICENSE = Artistic or GPL-1.0+
PERL_DBD_MYSQL_LICENSE_FILES = LICENSE
PERL_DBD_MYSQL_CONF_OPTS = \
	--cflags="-I$(STAGING_DIR)/usr/include/mysql" \
	--libs="-L$(STAGING_DIR)/usr/lib -lmysqlclient -lpthread -lz -lm -ldl -lssl -lcrypto" \
	--mysql_config=$(STAGING_DIR)/usr/bin/mysql_config

$(eval $(perl-package))
