################################################################################
#
# perl-list-moreutils
#
################################################################################

PERL_LIST_MOREUTILS_VERSION = 0.428
PERL_LIST_MOREUTILS_SOURCE = List-MoreUtils-$(PERL_LIST_MOREUTILS_VERSION).tar.gz
PERL_LIST_MOREUTILS_SITE = $(BR2_CPAN_MIRROR)/authors/id/R/RE/REHSACK
PERL_LIST_MOREUTILS_DEPENDENCIES = host-perl-config-autoconf perl-exporter-tiny perl-list-moreutils-xs
PERL_LIST_MOREUTILS_LICENSE = Apache-2.0
PERL_LIST_MOREUTILS_LICENSE_FILES = ARTISTIC-1.0 LICENSE

$(eval $(perl-package))
