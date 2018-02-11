################################################################################
#
# perl-sql-abstract
#
################################################################################

PERL_SQL_ABSTRACT_VERSION = 1.85
PERL_SQL_ABSTRACT_SOURCE = SQL-Abstract-$(PERL_SQL_ABSTRACT_VERSION).tar.gz
PERL_SQL_ABSTRACT_SITE = $(BR2_CPAN_MIRROR)/authors/id/I/IL/ILMARI
PERL_SQL_ABSTRACT_DEPENDENCIES = perl-hash-merge perl-mro-compat perl-moo perl-sub-quote
PERL_SQL_ABSTRACT_LICENSE = Artistic or GPL-1.0+
PERL_SQL_ABSTRACT_LICENSE_FILES = README

$(eval $(perl-package))
