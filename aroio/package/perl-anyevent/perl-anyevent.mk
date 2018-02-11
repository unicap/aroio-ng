################################################################################
#
# perl-anyevent
#
################################################################################

PERL_ANYEVENT_VERSION = 7.14
PERL_ANYEVENT_SOURCE = AnyEvent-$(PERL_ANYEVENT_VERSION).tar.gz
PERL_ANYEVENT_SITE = $(BR2_CPAN_MIRROR)/authors/id/M/ML/MLEHMANN
PERL_ANYEVENT_DEPENDENCIES = host-perl-canary-stability
PERL_ANYEVENT_LICENSE_FILES = COPYING

$(eval $(perl-package))
