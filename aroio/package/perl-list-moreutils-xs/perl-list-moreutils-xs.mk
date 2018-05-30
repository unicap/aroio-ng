################################################################################
#
# perl-list-moreutils-xs
#
################################################################################

PERL_LIST_MOREUTILS_XS_VERSION = 0.428
PERL_LIST_MOREUTILS_XS_SOURCE = List-MoreUtils-XS-$(PERL_LIST_MOREUTILS_XS_VERSION).tar.gz
PERL_LIST_MOREUTILS_XS_SITE = $(BR2_CPAN_MIRROR)/authors/id/R/RE/REHSACK
PERL_LIST_MOREUTILS_XS_DEPENDENCIES = host-perl-config-autoconf host-perl-inc-latest
PERL_LIST_MOREUTILS_XS_LICENSE = Apache-2.0
PERL_LIST_MOREUTILS_XS_LICENSE_FILES = ARTISTIC-1.0 LICENSE

$(eval $(perl-package))
$(eval $(host-perl-package))
