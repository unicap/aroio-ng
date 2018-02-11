################################################################################
#
# perl-font-freetype
#
################################################################################

PERL_FONT_FREETYPE_VERSION = 0.09
PERL_FONT_FREETYPE_SOURCE = Font-FreeType-$(PERL_FONT_FREETYPE_VERSION).tar.gz
PERL_FONT_FREETYPE_SITE = $(BR2_CPAN_MIRROR)/authors/id/D/DM/DMOL
PERL_FONT_FREETYPE_DEPENDENCIES = host-perl-devel-checklib host-perl-file-which
PERL_FONT_FREETYPE_LICENSE = Artistic or GPL-1.0+

$(eval $(perl-package))
