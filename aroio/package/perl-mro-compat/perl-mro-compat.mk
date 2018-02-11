################################################################################
#
# perl-mro-compat
#
################################################################################

PERL_MRO_COMPAT_VERSION = 0.13
PERL_MRO_COMPAT_SOURCE = MRO-Compat-$(PERL_MRO_COMPAT_VERSION).tar.gz
PERL_MRO_COMPAT_SITE = $(BR2_CPAN_MIRROR)/authors/id/H/HA/HAARG
PERL_MRO_COMPAT_LICENSE = Artistic or GPL-1.0+
PERL_MRO_COMPAT_LICENSE_FILES = README

$(eval $(perl-package))
