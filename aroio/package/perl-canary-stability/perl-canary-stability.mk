################################################################################
#
# perl-canary-stability
#
################################################################################

PERL_CANARY_STABILITY_VERSION = 2012
PERL_CANARY_STABILITY_SOURCE = Canary-Stability-$(PERL_CANARY_STABILITY_VERSION).tar.gz
PERL_CANARY_STABILITY_SITE = $(BR2_CPAN_MIRROR)/authors/id/M/ML/MLEHMANN
PERL_CANARY_STABILITY_LICENSE_FILES = COPYING

$(eval $(host-perl-package))
