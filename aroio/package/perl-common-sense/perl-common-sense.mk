################################################################################
#
# perl-common-sense
#
################################################################################

PERL_COMMON_SENSE_VERSION = 3.74
PERL_COMMON_SENSE_SOURCE = common-sense-$(PERL_COMMON_SENSE_VERSION).tar.gz
PERL_COMMON_SENSE_SITE = $(BR2_CPAN_MIRROR)/authors/id/M/ML/MLEHMANN
PERL_COMMON_SENSE_LICENSE_FILES = LICENSE

$(eval $(perl-package))
