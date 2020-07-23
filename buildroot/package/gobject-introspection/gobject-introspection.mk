################################################################################
#
# gobject-introspection
#
################################################################################

GOBJECT_INTROSPECTION_VERSION_MAJOR = 1.56
GOBJECT_INTROSPECTION_VERSION = $(GOBJECT_INTROSPECTION_VERSION_MAJOR).1
GOBJECT_INTROSPECTION_SITE = http://ftp.gnome.org/pub/GNOME/sources/gobject-introspection/$(GOBJECT_INTROSPECTION_VERSION_MAJOR)
GOBJECT_INTROSPECTION_SOURCE = gobject-introspection-$(GOBJECT_INTROSPECTION_VERSION).tar.xz
GOBJECT_INTROSPECTION_DEPENDENCIES = libffi zlib libglib2 host-qemu host-gobject-introspection host-prelink-cross
GOBJECT_INTROSPECTION_INSTALL_STAGING = YES
GOBJECT_INTROSPECTION_AUTORECONF = YES
GOBJECT_INTROSPECTION_LICENSE = Dual LGPLv2+/GPLv2+
GOBJECT_INTROSPECTION_LICENSE_FILES = COPYING.LGPL COPYING.GPL
HOST_GOBJECT_INTROSPECTION_DEPENDENCIES = host-libglib2 host-flex host-bison

GOBJECT_INTROSPECTION_CONF_OPTS = \
	--enable-host-gi \
	--disable-static \
	--enable-gi-cross-wrapper=$(STAGING_DIR)/usr/bin/g-ir-scanner-qemuwrapper \
	--enable-gi-ldd-wrapper=$(STAGING_DIR)/usr/bin/g-ir-scanner-lddwrapper \
	--enable-introspection-data

ifeq ($(BR2_PACKAGE_CAIRO),y)
GOBJECT_INTROSPECTION_DEPENDENCIES += cairo
endif
ifeq ($(BR2_PACKAGE_LIBFFI),y)
GOBJECT_INTROSPECTION_DEPENDENCIES += libffi
endif

ifeq ($(BR2_PACKAGE_PYTHON),y)
GOBJECT_INTROSPECTION_DEPENDENCIES += python
HOST_GOBJECT_INTROSPECTION_DEPENDENCIES += host-python
GOBJECT_INTROSPECTION_PYTHON_PATH="$(STAGING_DIR)/usr/bin/python2"
else
GOBJECT_INTROSPECTION_DEPENDENCIES += python3
HOST_GOBJECT_INTROSPECTION_DEPENDENCIES += host-python3
GOBJECT_INTROSPECTION_PYTHON_PATH="$(STAGING_DIR)/usr/bin/python3"
endif

# GI_SCANNER_DISABLE_CACHE=1 prevents g-ir-scanner from writing cache data to $HOME
HOST_GOBJECT_INTROSPECTION_CONF_ENV = \
	GI_SCANNER_DISABLE_CACHE=1 \
	HOST_GOBJECT_INTROSPECTION_GIR_EXTRA_LIBS_PATH=$(@D)/.libs

# GI_SCANNER_DISABLE_CACHE=1 prevents g-ir-scanner from writing cache data to $HOME
GOBJECT_INTROSPECTION_CONF_ENV = \
	GI_SCANNER_DISABLE_CACHE=1 \
	GOBJECT_INTROSPECTION_GIR_EXTRA_LIBS_PATH=$(@D)/.libs \
	PYTHON_INCLUDES="`$(GOBJECT_INTROSPECTION_PYTHON_PATH)-config --includes`"

# Make sure g-ir-tool-template uses the host python.
define GOBJECT_INTROSPECTION_FIX_TOOLTEMPLATE_PYTHON_PATH
	sed -i -e '1s,#!.*,#!$(HOST_DIR)/bin/python,' $(@D)/tools/g-ir-tool-template.in
endef
GOBJECT_INTROSPECTION_PRE_CONFIGURE_HOOKS = GOBJECT_INTROSPECTION_FIX_TOOLTEMPLATE_PYTHON_PATH
HOST_GOBJECT_INTROSPECTION_PRE_CONFIGURE_HOOKS = GOBJECT_INTROSPECTION_FIX_TOOLTEMPLATE_PYTHON_PATH

GOBJECT_INTROSPECTION_WRAPPERS = \
	g-ir-compiler \
	g-ir-scanner

# These wrappers allow gobject-introspection to build the internal introspection
# libraries during the build process.
define GOBJECT_INTROSPECTION_INSTALL_PRE_WRAPPERS
	$(INSTALL) -D -m 755 package/gobject-introspection/g-ir-scanner-lddwrapper.in $(STAGING_DIR)/usr/bin/g-ir-scanner-lddwrapper
	$(INSTALL) -D -m 755 package/gobject-introspection/g-ir-scanner-qemuwrapper.in $(STAGING_DIR)/usr/bin/g-ir-scanner-qemuwrapper
	$(SED) "s|@QEMU_USER@|$(QEMU_USER)|g" $(STAGING_DIR)/usr/bin/g-ir-scanner-qemuwrapper
	$(SED) "s|@TOOLCHAIN_HEADERS_VERSION@|$(BR2_TOOLCHAIN_HEADERS_AT_LEAST)|g" $(STAGING_DIR)/usr/bin/g-ir-scanner-qemuwrapper
endef
GOBJECT_INTROSPECTION_POST_PATCH_HOOKS = GOBJECT_INTROSPECTION_INSTALL_PRE_WRAPPERS

# In order for gobject-introspection to work, qemu needs to run temporarily
# to create binaries on the fly by g-ir-scanner. This involves creating
# several wrapper scripts to accomplish the task:
# g-ir-scanner-qemuwrapper, g-ir-compiler-wrapper,
# g-ir-scanner-lddwrapper, g-ir-scanner-wrapper, g-ir-compiler-wrapper.
define GOBJECT_INTROSPECTION_INSTALL_WRAPPERS
	# Move the real binaries to their names.real, then replace them with
	# the wrappers.
	$(foreach w,$(GOBJECT_INTROSPECTION_WRAPPERS),
		mv $(STAGING_DIR)/usr/bin/$(w) $(STAGING_DIR)/usr/bin/$(w).real
		$(INSTALL) -D -m 755 \
		package/gobject-introspection/$(w).in $(STAGING_DIR)/usr/bin/$(w)
	)
	$(SED) "s@g_ir_scanner=.*@g_ir_scanner=$(STAGING_DIR)/usr/bin/g-ir-scanner@g" \
	$(STAGING_DIR)/usr/lib/pkgconfig/gobject-introspection-1.0.pc

	# The pkgconfig file needs to point towards the wrappers instead of the native
	# binaries.
	$(SED) "s@g_ir_compiler=.*@g_ir_compiler=$(STAGING_DIR)/usr/bin/g-ir-compiler@g" \
	$(STAGING_DIR)/usr/lib/pkgconfig/gobject-introspection-1.0.pc
endef
GOBJECT_INTROSPECTION_POST_INSTALL_STAGING_HOOKS = GOBJECT_INTROSPECTION_INSTALL_WRAPPERS

$(eval $(autotools-package))
$(eval $(host-autotools-package))
