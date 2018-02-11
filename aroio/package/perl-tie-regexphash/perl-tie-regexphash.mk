################################################################################
#
# perl-tie-regexphash
#
################################################################################

PERL_TIE_REGEXPHASH_VERSION = 0.17
PERL_TIE_REGEXPHASH_SOURCE = Tie-RegexpHash-$(PERL_TIE_REGEXPHASH_VERSION).tar.gz
PERL_TIE_REGEXPHASH_SITE = $(BR2_CPAN_MIRROR)/authors/id/A/AL/ALTREUS
PERL_TIE_REGEXPHASH_LICENSE_FILES = README

$(eval $(perl-package))
