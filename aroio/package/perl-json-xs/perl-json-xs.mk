################################################################################
#
# perl-json-xs
#
################################################################################

PERL_JSON_XS_VERSION = 3.04
PERL_JSON_XS_SOURCE = JSON-XS-$(PERL_JSON_XS_VERSION).tar.gz
PERL_JSON_XS_SITE = $(BR2_CPAN_MIRROR)/authors/id/M/ML/MLEHMANN
PERL_JSON_XS_DEPENDENCIES = host-perl-canary-stability perl-types-serialiser perl-common-sense
PERL_JSON_XS_LICENSE_FILES = COPYING

$(eval $(perl-package))
