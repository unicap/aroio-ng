################################################################################
#
# perl-types-serialiser
#
################################################################################

PERL_TYPES_SERIALISER_VERSION = 1.0
PERL_TYPES_SERIALISER_SOURCE = Types-Serialiser-$(PERL_TYPES_SERIALISER_VERSION).tar.gz
PERL_TYPES_SERIALISER_SITE = $(BR2_CPAN_MIRROR)/authors/id/M/ML/MLEHMANN
PERL_TYPES_SERIALISER_DEPENDENCIES = perl-common-sense
PERL_TYPES_SERIALISER_LICENSE_FILES = COPYING

$(eval $(perl-package))
