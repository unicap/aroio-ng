################################################################################
#
# perl-sql-abstract-limit
#
################################################################################

PERL_SQL_ABSTRACT_LIMIT_VERSION = 0.141
PERL_SQL_ABSTRACT_LIMIT_SOURCE = SQL-Abstract-Limit-$(PERL_SQL_ABSTRACT_LIMIT_VERSION).tar.gz
PERL_SQL_ABSTRACT_LIMIT_SITE = $(BR2_CPAN_MIRROR)/authors/id/D/DA/DAVEBAIRD
PERL_SQL_ABSTRACT_LIMIT_DEPENDENCIES = perl-dbi perl-sql-abstract
PERL_SQL_ABSTRACT_LIMIT_LICENSE_FILES = README

$(eval $(perl-package))
