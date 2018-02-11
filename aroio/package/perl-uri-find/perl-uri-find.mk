################################################################################
#
# perl-uri-find
#
################################################################################

PERL_URI_FIND_VERSION = 20160806
PERL_URI_FIND_SOURCE = URI-Find-$(PERL_URI_FIND_VERSION).tar.gz
PERL_URI_FIND_SITE = $(BR2_CPAN_MIRROR)/authors/id/M/MS/MSCHWERN
PERL_URI_FIND_DEPENDENCIES = host-perl-module-build perl-uri
PERL_URI_FIND_LICENSE = Artistic or GPL-1.0+
PERL_URI_FIND_LICENSE_FILES = LICENSE

$(eval $(perl-package))
