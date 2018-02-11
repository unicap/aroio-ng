################################################################################
#
# perl-clone-choose
#
################################################################################

PERL_CLONE_CHOOSE_VERSION = 0.008
PERL_CLONE_CHOOSE_SOURCE = Clone-Choose-$(PERL_CLONE_CHOOSE_VERSION).tar.gz
PERL_CLONE_CHOOSE_SITE = $(BR2_CPAN_MIRROR)/authors/id/H/HE/HERMES
PERL_CLONE_CHOOSE_LICENSE = Artistic or GPL-1.0+

$(eval $(perl-package))
